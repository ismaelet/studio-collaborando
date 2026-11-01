<script lang="ts">
  import { page } from "@inertiajs/svelte";
  import Icon from "./Icon.svelte";
</script>

<!-- {#each Object.entries($page.props.site.social) as [slug, contact]}
  <a
    href={contact.url}
    aria-label={contact.label}
    target="_blank"
    rel="noreferrer"
    class="w-6 aspect-square flex justify-center hover:text-primary-400 transition-colors"
    ><Icon name={`icons/contacts/${slug}`} /></a
  >
{/each} -->
