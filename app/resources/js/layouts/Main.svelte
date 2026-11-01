<script lang="ts">
  import type { Snippet } from "svelte";

  // import Header from "@/components/header/Header.svelte";
  // import Footer from "@/components/footer/Footer.svelte";

  let {
    location,
    children,
  }: {
    location?: string;
    children: Snippet;
  } = $props();
</script>

<div class="view-wrapper">
  <!-- <Header currentLocation={location} /> -->

  <main>
    <div class="content-grid">
      {@render children()}
    </div>
  </main>
</div>

<!-- <Footer /> -->

<style>
  .view-wrapper {
    display: grid;
    grid-template-columns: minmax(0, 1fr);
    grid-template-rows: max-content minmax(0, 1fr);
    min-height: 100svh;
  }

  main {
    display: grid;
    grid-template-columns: minmax(0, 1fr);
  }
</style>
