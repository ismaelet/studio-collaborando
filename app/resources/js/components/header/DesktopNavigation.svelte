<script lang="ts">
  import DesktopLink from "./DesktopLink.svelte";
  import type { NavigationLink } from "./HeaderContext";

  let { links }: { links: NavigationLink[] } = $props();
</script>

<nav class="desktop-navigation">
  <ul class="flex items-center gap-8">
    {#each links as link, index (link.locationTag)}
      <DesktopLink {link} />
      {#if index < links.length - 1}
        <li role="presentation" class="font-alt text-primary-400 cursor-default text-lg">//</li>
      {/if}
    {/each}
  </ul>
</nav>
