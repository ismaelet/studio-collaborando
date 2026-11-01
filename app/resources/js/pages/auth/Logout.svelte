<script>
  import { useForm, page } from "@inertiajs/svelte";
  import Auth from "../../layouts/Auth.svelte";
  import Input from "../../components/Input.svelte";
  import Button from "../../components/Button.svelte";
  export let title = "Logout";
  const form = useForm({});
</script>

<Auth {title}>
  <form
    class="grid gap-6"
    onsubmit={(event) => {
      event.preventDefault();
      $form.post("/logout", { onFinish: () => $form.reset() });
    }}
  >
    <p>Desideri davvero disconnetterti?</p>
    {#if $page.props.flash.status}<p role="alert">{$page.props.flash.status}</p>{/if}
    {#if $page.props.flash.not_found}<p role="alert">
        Non abbiamo trovato nessun account associato all'indirizzo email indicato
      </p>{/if}
    <Button type="submit" disabled={$form.processing}>Esci</Button>
    <Button href="/user-dashboard" variant="secondary">Indietro</Button>
  </form>
</Auth>
