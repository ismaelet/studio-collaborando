<script lang="ts">
  import Logo from "@/components/svg/Logo.svelte";

  let { className = "" }: { className?: string } = $props();
</script>

<div class="grid grid-cols-[max-content_minmax(0,1fr)] items-center gap-4 {className}">
  <a href="/">
    <Logo class="w-14 shrink-0" />
  </a>

  <div>
    <p class="font-heading text-secondary-500 text-2xl font-medium">Michael Ende</p>
    <p class="text-neutral-text text-sm uppercase">Die Unendliche Geschichte</p>
  </div>
</div>
