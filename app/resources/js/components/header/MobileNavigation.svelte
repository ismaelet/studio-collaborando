<script lang="ts">
  import { getContext } from "svelte";
  import MobileLink from "./MobileLink.svelte";
  import { HEADER_CONTEXT, type HeaderContextValue, type NavigationLink } from "./HeaderContext";

  let { links }: { links: NavigationLink[] } = $props();
  const header = getContext<HeaderContextValue>(HEADER_CONTEXT);
</script>

<nav
  class="mobile-navigation bg-background-400 grid items-center transition-opacity"
  data-navigation-open={header.navigationIsOpen}
>
  <ul class="flex flex-col justify-between gap-8 text-center sm:gap-16">
    {#each links as link (link.locationTag)}
      <MobileLink {link} onClick={() => header.toggleNavigation(false)}>
        {link.label}
      </MobileLink>
    {/each}
  </ul>
</nav>

<style>
  .mobile-navigation {
    --_delay-interval: 50ms;
    position: fixed;
    inset: 0;
    height: 100vh;
    padding-inline: var(--spacing-content-padding);
  }

  :global(header:not([data-navigation-open="true"])) .mobile-navigation {
    opacity: 0;
    visibility: hidden;
  }

  :global(.mobile-navigation[data-navigation-open="false"] li) {
    opacity: 0;
    translate: 0 2rem;
  }

  .mobile-navigation ul {
    pointer-events: all;
    min-height: 50vh;
  }

  :global(.mobile-navigation li) {
    transition:
      opacity 200ms,
      translate 200ms;
    transition-delay: calc(var(--_delay-interval) * sibling-index() / 1.5);
  }
</style>
