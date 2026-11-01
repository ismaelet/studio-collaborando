<script>
  import { Link, page } from '@inertiajs/svelte'
  import Main from './Main.svelte'
  export let title = 'Profilo'
  let open = false
  const links = [['Account', '/user-dashboard'], ['I miei corsi', '/user-dashboard/courses'], ['I miei dati', '/user-dashboard/personal-data'], ['Logout', '/logout']]
</script>
<Main {title}>
  <div class="dashboard-body grid gap-12 my-8 md:my-20">
    <nav class="surface self-start" aria-label="Profilo">
      <button class="md:hidden p-4" onclick={() => open = !open} aria-expanded={open}>Profilo</button>
      <ul class="profile-links" class:open>{#each links as [label, href]}<li><Link {href} class="block p-4" aria-current={$page.url === href ? 'page' : undefined}>{label}</Link></li>{/each}</ul>
    </nav>
    <div class="grid gap-8 content-start"><slot /></div>
  </div>
</Main>
