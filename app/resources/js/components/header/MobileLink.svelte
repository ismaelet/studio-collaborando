<script lang="ts">
  import type { Snippet } from "svelte";
  import type { NavigationLink } from "./HeaderContext";

  let {
    link,
    style,
    onClick,
    children,
  }: {
    link: NavigationLink;
    style?: string;
    onClick?: (event: MouseEvent) => void;
    children?: Snippet;
  } = $props();
</script>

<li {style}>
  <a
    class="font-heading hover:text-primary text-xl tracking-wider transition-colors sm:text-2xl"
    href={link.route}
    onclick={onClick}
  >
    {@render children?.()}
  </a>
</li>
