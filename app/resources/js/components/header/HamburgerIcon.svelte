<script lang="ts">
  import { getContext } from "svelte";
  import { HEADER_CONTEXT, type HeaderContextValue } from "./HeaderContext";

  let { className = "" }: { className?: string } = $props();
  const header = getContext<HeaderContextValue>(HEADER_CONTEXT);
</script>

<button
  type="button"
  class={`hamburger-icon text-heading-400 stack-content grid cursor-pointer appearance-none items-center justify-items-end border-0 bg-transparent p-0 ${className}`}
  data-type="default"
  aria-label={header.navigationIsOpen ? "Navigation schließen" : "Navigation öffnen"}
  aria-expanded={header.navigationIsOpen}
  onclick={() => header.toggleNavigation()}
>
  <span class="bg-neutral-text"></span>
  <span class="bg-neutral-text"></span>
  <span class="bg-neutral-text"></span>
</button>

<style>
  .hamburger-icon {
    height: 1.4rem;
    aspect-ratio: 1.2;
  }

  .hamburger-icon span {
    position: relative;
    height: 2px;
    border-radius: 100vw;
  }

  .hamburger-icon span:nth-child(1) {
    bottom: 50%;
    translate: 0 100%;
    width: 77%;
    transition: all ease-in-out 0.2s;
  }

  .hamburger-icon span:nth-child(2) {
    width: 59%;
    transition: all ease-in-out 0.2s;
  }

  .hamburger-icon span:nth-child(3) {
    top: 50%;
    translate: 0 -100%;
    width: 100%;
    transition: all ease-in-out 0.2s;
  }

  :global(header[data-navigation-open="true"]) .hamburger-icon span {
    width: 100%;
  }

  :global(header[data-navigation-open="true"]) .hamburger-icon span:nth-child(1) {
    bottom: 0;
    translate: 0;
    rotate: 45deg;
  }

  :global(header[data-navigation-open="true"]) .hamburger-icon span:nth-child(2) {
    opacity: 0;
    translate: -4rem 0;
  }

  :global(header[data-navigation-open="true"]) .hamburger-icon span:nth-child(3) {
    top: 0;
    translate: 0;
    rotate: -45deg;
  }

  :global(.hamburger-icon[data-type="simple"] span:nth-child(2)) {
    display: none;
  }
</style>
