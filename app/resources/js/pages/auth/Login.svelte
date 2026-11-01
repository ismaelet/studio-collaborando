<script>
  import { useForm, page } from "@inertiajs/svelte";
  import Auth from "../../layouts/Auth.svelte";
  import Input from "../../components/Input.svelte";
  import Button from "../../components/Button.svelte";
  import image from "../../../images/auth/login-image.webp";
  export let title = "Login";
  const form = useForm({ email: "", password: "" });
</script>

<Auth {title} {image}>
  <form
    class="grid gap-6"
    onsubmit={(event) => {
      event.preventDefault();
      $form.post("/login", { onFinish: () => $form.reset("password") });
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
    <Input
      name="password"
      label="Password"
      type="password"
      bind:value={$form.password}
      error={$form.errors.password}
      required
    />
    {#if $page.props.flash.status}<p role="alert">{$page.props.flash.status}</p>{/if}
    {#if $page.props.flash.not_found}<p role="alert">
        Non abbiamo trovato nessun account associato all'indirizzo email indicato
      </p>{/if}
    <Button type="submit" disabled={$form.processing}>Login</Button>
    <a href="/recover">Hai dimenticato i dati di accesso?</a><Button
      href="/register"
      variant="secondary">Registrati</Button
    >
  </form>
</Auth>
