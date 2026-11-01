<script>
  import { page, useForm } from "@inertiajs/svelte";
  import Dashboard from "../../layouts/UserDashboard.svelte";
  import Panel from "../../components/Panel.svelte";
  import Input from "../../components/Input.svelte";
  import Button from "../../components/Button.svelte";
  export let title = "Profilo - Dati personali";
  const user = $page.props.auth.user;
  const profile = useForm({
    first_name: user.first_name || "",
    last_name: user.last_name || "",
    email: user.email,
  });
  const password = useForm({ old_password: "", password: "", password_confirmation: "" });
</script>

<Dashboard {title}
  ><Panel title="Dati personali" icon="user">
    {#if $page.props.flash.success}<p role="status">{$page.props.flash.success}</p>{/if}
    <div class="grid gap-12">
      <form
        class="grid gap-6"
        onsubmit={(e) => {
          e.preventDefault();
          $profile.post("/user-dashboard/personal-data");
        }}
      >
        <h3>I miei dati</h3>
        <Input
          name="first_name"
          label="Nome"
          bind:value={$profile.first_name}
          error={$profile.errors.first_name}
          required
        />
        <Input
          name="last_name"
          label="Cognome"
          bind:value={$profile.last_name}
          error={$profile.errors.last_name}
          required
        />
        <Input
          name="email"
          label="Indirizzo e-mail"
          type="email"
          bind:value={$profile.email}
          error={$profile.errors.email}
          required
        />
        <Button type="submit" variant="secondary" size="sm" disabled={$profile.processing}
          >Modifica</Button
        >
      </form>
      <form
        class="grid gap-6"
        onsubmit={(e) => {
          e.preventDefault();
          $password.post("/user-dashboard/password", { onSuccess: () => $password.reset() });
        }}
      >
        <h3>Modifica la password</h3>
        <Input
          name="old_password"
          label="Password precedente"
          type="password"
          bind:value={$password.old_password}
          error={$password.errors.old_password}
          required
        />
        <Input
          name="password"
          label="Nuova password"
          type="password"
          bind:value={$password.password}
          error={$password.errors.password}
          required
        />
        <Input
          name="password_confirmation"
          label="Conferma la nuova password"
          type="password"
          bind:value={$password.password_confirmation}
          required
        />
        <Button type="submit" variant="secondary" size="sm" disabled={$password.processing}
          >Modifica</Button
        >
      </form>
    </div>
  </Panel></Dashboard
>
