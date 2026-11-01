<script>
  import { useForm, page } from "@inertiajs/svelte";
  import Auth from "../../layouts/Auth.svelte";
  import Input from "../../components/Input.svelte";
  import Button from "../../components/Button.svelte";
  import image from "../../../images/auth/register-image.webp";
  export let title = "Registrati";
  const form = useForm({
    first_name: "",
    last_name: "",
    email: "",
    password: "",
    password_confirmation: "",
  });
</script>

<Auth {title} {image}>
  <form
    class="grid gap-6"
    onsubmit={(event) => {
      event.preventDefault();
      $form.post("/register", { onFinish: () => $form.reset("password", "password_confirmation") });
    }}
  >
    <Input
      name="first_name"
      label="Nome"
      type="text"
      bind:value={$form.first_name}
      error={$form.errors.first_name}
      required
    />
    <Input
      name="last_name"
      label="Cognome"
      type="text"
      bind:value={$form.last_name}
      error={$form.errors.last_name}
      required
    />
    <Input
      name="email"
      label="Indirizzo e-mail"
      type="email"
      bind:value={$form.email}
      error={$form.errors.email}
      required
    />
    <Input
      name="password"
      label="Password"
      type="password"
      bind:value={$form.password}
      error={$form.errors.password}
      required
    />
    <Input
      name="password_confirmation"
      label="Conferma la password"
      type="password"
      bind:value={$form.password_confirmation}
      error={$form.errors.password_confirmation}
      required
    />
    {#if $page.props.flash.status}<p role="alert">{$page.props.flash.status}</p>{/if}
    {#if $page.props.flash.not_found}<p role="alert">
        Non abbiamo trovato nessun account associato all'indirizzo email indicato
      </p>{/if}
    <Button type="submit" disabled={$form.processing}>Registrati</Button>
    <Button href="/login" variant="secondary">Torna al login</Button>
  </form>
</Auth>
