<script>
  import Main from './Main.svelte'
  export let title
  export let image = null
</script>
<Main {title} floating={!!image}>
  <div class:full-width={!!image} class:page__content={!!image} class="grid">
    {#if image}<section class="welcome grid"><div class="welcome__image" style={`background-image: url(${image})`}></div></section>{/if}
    <section class="page__form grid content-center justify-items-center py-16 md:px-8">
      <div class="auth-form-content grid gap-12"><h1 class="main-heading text-center">{title}</h1><slot /></div>
    </section>
  </div>
</Main>
<style>
  .auth-form-content { width: min(100%, 28rem); }
  .welcome__image { min-height: 100svh; }
  @media (max-width: 768px) { .welcome__image { min-height: 25rem; } }
</style>
