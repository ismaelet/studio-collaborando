@php
    $directory = public_path('uploads/courses/1');
    $videos = glob($directory . '/*.mp4');
    $purchased = App\Models\Ecommerce\Cart::where('statusId', '>', 0)
        ->where('customerId', Auth::user()->id)
        ->count();

    if (in_array(Auth::user()->email, ['jerry18@libero.it', 'quipopi@gmail.com', 'dsa.trentino@gmail.com', 'quadrifoglio.dsa.tn@gmail.com', 'sara.sperandio92@gmail.com'])) {
        $purchased = true;
    }
@endphp

@pushOnce('styles')
    <style>
        .course-video {
            background-color: #ddd;
        }

        .course-video__overlay {
            opacity: 1;
            background-color: hsla(0, 0%, 70%, .8);
            transition: opacity 0.3s;

            [data-playing="true"] & {
                opacity: 0;
            }
        }
    </style>
@endpushOnce

@pushOnce('scripts')
    <script defer>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.js-video-toggler').forEach((element) => {
                element.addEventListener('click', function() {
                    video = element.querySelector('video');

                    if (video.paused) {
                        element.dataset.playing = true;
                        video.play();
                    } else {
                        element.dataset.playing = false;
                        video.pause();
                    }
                });
            })
        });
    </script>
@endpushOnce

<x-templates.user-dashboard>

    @if ($purchased)

        <x-templates.user-dashboard.panel :icon="'courses'" :title="'Gestire le fragilità scolastiche a casa'">
            <div class="grid gap-12">
                @foreach ($videos as $material)
                    <div>
                        <h4 class="text-lg font-heading font-semibold mb-4">{{ pathinfo($material, PATHINFO_FILENAME) }}
                        </h4>
                        <div class="course-video grid stack-content cursor-pointer js-video-toggler" data-playing="false">
                            <video width="100%" height="auto" loading="lazy" class="">
                                <source src="/{{ explode('/public/', $material)[1] }}" type="video/mp4">
                                Your browser does not support the video tag.

                                </source>
                            </video>

                            <div class="course-video__overlay grid items-center justify-items-center">
                                <span class="w-12 text-neutral-light-100">
                                    {{ import_svg('icons/play') }}
                                </span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </x-templates.user-dashboard.panel>
    @else
        <x-templates.user-dashboard.panel :icon="'courses'" :title="'I miei corsi'">
            <div class="grid gap-12">
                <p class="text-center text-lg my-16">Ancora non hai acquistato nessun corso</p>
            </div>
        </x-templates.user-dashboard.panel>

    @endif

</x-templates.user-dashboard>
