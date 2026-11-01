<script>
  import { page } from "@inertiajs/svelte";
  import Dashboard from "../../layouts/UserDashboard.svelte";
  import Panel from "../../components/Panel.svelte";
  import Button from "../../components/Button.svelte";
  export let title = "Profilo";
  export let materials = [];
  $: user = $page.props.auth.user;
</script>

<Dashboard {title}>
  <Panel title="Account" icon="user"
    ><div class="grid gap-6">
      <div>
        <h3>I miei dati</h3>
        <p>
          Nominativo: {[user.first_name, user.last_name].filter(Boolean).join(" ") || user.name}
        </p>
        <p>Indirizzo e-mail: {user.email}</p>
      </div>
      <Button href="/user-dashboard/personal-data" variant="secondary" size="sm">Modifica</Button>
    </div></Panel
  >
  <Panel title="Materiali gratuiti" icon="documents"
    ><div class="grid gap-2">
      {#each materials as material}<a href={material.url} download>{material.name}</a>{/each}
    </div></Panel
  >
</Dashboard>
