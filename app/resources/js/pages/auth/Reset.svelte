<script>
  import { useForm, page } from "@inertiajs/svelte";
  import Auth from "../../layouts/Auth.svelte";
  import Input from "../../components/Input.svelte";
  import Button from "../../components/Button.svelte";
  export let title = "Reset accesso";
  export let userId;
  export let securityCode;
  const form = useForm({
    password: "",
    password_confirmation: "",
    user_id: userId,
    security_code: securityCode,
  });
</script>

<Auth {title}>
  {#if $page.props.flash.submitted}<p role="status">Password cambiata con successo!</p>
    <Button href="/login">Torna al login</Button>{:else}
    <form
      class="grid gap-6"
      onsubmit={(event) => {
        event.preventDefault();
        $form.post("/reset", { onFinish: () => $form.reset("password", "password_confirmation") });
      }}
    >
      <Input
        name="password"
        label="Nuova password"
        type="password"
        bind:value={$form.password}
        error={$form.errors.password}
        required
      />
      <Input
        name="password_confirmation"
        label="Conferma la nuova password"
        type="password"
        bind:value={$form.password_confirmation}
        error={$form.errors.password_confirmation}
        required
      />
      {#if $page.props.flash.status}<p role="alert">{$page.props.flash.status}</p>{/if}
      {#if $page.props.flash.not_found}<p role="alert">
          Non abbiamo trovato nessun account associato all'indirizzo email indicato
        </p>{/if}
      <Button type="submit" disabled={$form.processing}>Reimposta la password</Button>
      <Button href="/login" variant="secondary">Torna al login</Button>
    </form>
  {/if}
</Auth>
