<script>
  import Button from './Button.svelte'
  import SocialLinks from './SocialLinks.svelte'
  import background from '../../images/home/slider-background.webp'
</script>
<section class="slider full-width grid stack-content text-neutral-light-100" data-local-theme="dark">
  <div class="slider__background bg-center bg-cover opacity-50" style={`background-image: url(${background})`}></div>
  <div class="slider__content relative grid items-center min-h-full sm:px-8">
    <aside class="slider__contacts hidden lg:grid gap-8 justify-items-center" aria-label="Contatti"><div class="slider-bar"></div><SocialLinks /><div class="slider-bar slider-bar--hidden"></div></aside>
    <div class="slider__body grid gap-20 py-16 text-center justify-items-center content-center mt-8">
      <div class="grid gap-12 lg:gap-20"><h1 class="main-heading text-neutral-light-100">Studio Collaborando</h1>
        <p class="font-heading text-base md:text-2xl font-extralight leading-loose tracking-[.2em] uppercase">Sara Sperandio<br />laboratori e psicologia</p>
        <div class="flex justify-center gap-6 lg:hidden"><SocialLinks /></div>
      </div>
      <Button href="#bio">Esplora</Button>
    </div>
    <aside class="slider__scroller hidden lg:block"><a href="#bio" class="grid gap-8 justify-items-center"><div class="slider-bar slider-bar--hidden"></div><p class="slider__explore uppercase text-lg font-heading font-light tracking-[.2em]">esplora</p><div class="slider-bar"></div></a></aside>
  </div>
</section>
<style>
  .slider__background { filter: saturate(1.4); }
  .slider-bar { width: 1px; height: 5rem; background: var(--color-neutral-light-300); opacity: .3; }
  .slider-bar--hidden { visibility: hidden; }
  .slider__explore { writing-mode: vertical-rl; text-orientation: mixed; }
  @media (min-width: 1024px) { .slider__content { grid-template-columns: max-content 1fr max-content; } }
</style>
