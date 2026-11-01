<script>
  import { useForm, page } from "@inertiajs/svelte";
  import Auth from "../../layouts/Auth.svelte";
  import Input from "../../components/Input.svelte";
  import Button from "../../components/Button.svelte";
  export let title = "Recupero accesso";
  const form = useForm({ email: "" });
</script>

<Auth {title}>
  {#if $page.props.flash.submitted && !$page.props.flash.not_found}<p>
      Abbiamo mandato un'email con le istruzioni per resettare la password a {$page.props.flash
        .email}. Controlla anche la cartella di spam.
    </p>
    <Button href="/login" variant="secondary">Torna al login</Button>{:else}
    <p>
      Inserisci l'indirizzo email associato al tuo account e ti manderemo un'email con le istruzioni
      per resettare la password.
    </p>
    <form
      class="grid gap-6"
      onsubmit={(event) => {
        event.preventDefault();
        $form.post("/recover", { onFinish: () => $form.reset() });
      }}
    >
      <Input
        name="email"
        label="Indirizzo e-mail"
        type="email"
        bind:value={$form.email}
        error={$form.errors.email}
        required
      />
      {#if $page.props.flash.status}<p role="alert">{$page.props.flash.status}</p>{/if}
      {#if $page.props.flash.not_found}<p role="alert">
          Non abbiamo trovato nessun account associato all'indirizzo email indicato
        </p>{/if}
      <Button type="submit" disabled={$form.processing}>Recupera i dati</Button>
      <Button href="/login" variant="secondary">Torna al login</Button>
    </form>
  {/if}
</Auth>
