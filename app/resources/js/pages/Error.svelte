<script>
  import Button from "@components/Button.svelte";
  export let status;
  $: message = status === 404 ? "Pagina non trovata" : "Sito in manutenzione";
</script>

<svelte:head><title>Errore {status} | Studio Collaborando</title></svelte:head>
<main class="content-grid min-h-screen content-center">
  <section class="text-center grid gap-8 justify-items-center">
    <h1 class="main-heading">Errore {status}</h1>
    <p>{message}</p>
    <Button href="/" variant="secondary">Torna alla home</Button>
  </section>
</main>
