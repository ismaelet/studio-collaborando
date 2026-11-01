<script lang="ts">
  import { onMount, setContext } from "svelte";
  import DesktopHeader from "./DesktopHeader.svelte";
  import MobileHeader from "./MobileHeader.svelte";
  import { HEADER_CONTEXT, type HeaderContextValue, type NavigationLink } from "./HeaderContext";

  const allowFloatingHeader = false;
  const links: NavigationLink[] = [
    { label: "Home", route: "home", locationTag: "home" },
    { label: "Zeitleiste", route: "timeline", locationTag: "timeline" },
    { label: "Inhalt", route: "documents", locationTag: "documents" },
    { label: "Suche", route: "search", locationTag: "search" },
  ];

  let { currentLocation }: { currentLocation?: string } = $props();
  let navigationIsOpen = $state(false);
  let headerElement: HTMLElement;
  let containerElement: HTMLDivElement;

  const headerContext: HeaderContextValue = {
    get currentLocation() {
      return currentLocation;
    },
    get navigationIsOpen() {
      return navigationIsOpen;
    },
    toggleNavigation(open) {
      navigationIsOpen = typeof open === "boolean" ? open : !navigationIsOpen;
    },
  };

  setContext(HEADER_CONTEXT, headerContext);

  onMount(() => {
    const syncHeight = () => {
      if (allowFloatingHeader || !headerElement || !containerElement) return;

      containerElement.style.height = `${headerElement.offsetHeight}px`;
    };

    syncHeight();

    const resizeObserver = new ResizeObserver(syncHeight);
    resizeObserver.observe(headerElement);
    window.addEventListener("resize", syncHeight);

    return () => {
      resizeObserver.disconnect();
      window.removeEventListener("resize", syncHeight);
    };
  });
</script>

<div bind:this={containerElement}>
  <header
    bind:this={headerElement}
    class="fixed top-0 left-0 z-10 w-full bg-background-300/80 shadow-2xl/5 backdrop-blur-md transition-colors"
    data-navigation-open={navigationIsOpen}
  >
    <DesktopHeader className="hidden lg:grid" {links} />
    <MobileHeader className="lg:hidden" {links} />
  </header>
</div>
