<script>
  import Dashboard from "../../layouts/UserDashboard.svelte";
  import Panel from "../../components/Panel.svelte";
  export let title = "Profilo - Videocorsi";
  export let purchased = false;
  export let videos = [];
</script>

<Dashboard {title}
  ><Panel
    title={purchased ? "Gestire le fragilità scolastiche a casa" : "I miei corsi"}
    icon="courses"
  >
    {#if purchased}<div class="grid gap-12">
        {#each videos as video}<div>
            <h3 class="mb-4">{video.name}</h3>
            <video controls preload="metadata" class="w-full"
              ><source src={video.url} type="video/mp4" /><track kind="captions" />Your browser does
              not support the video tag.</video
            >
          </div>{/each}
      </div>
    {:else}<p class="text-center my-16">Ancora non hai acquistato nessun corso</p>{/if}
  </Panel></Dashboard
>
