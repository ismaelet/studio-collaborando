<script lang="ts">
  import logo from "@images/logo/logo-full.png";

  type FooterLink = {
    name: string;
    route: string;
    icon?: "email";
  };

  type FooterColumn = {
    title: string;
    links: FooterLink[];
  };

  const columns: FooterColumn[] = [
    {
      title: "Navigation",
      links: [
        { name: "Zeitleiste", route: "timeline" },
        { name: "Inhalt", route: "documents" },
        { name: "Konditionen", route: "konditionen" },
        { name: "Suche", route: "search" },
      ],
    },
    {
      title: "Rechtliche Hinweise",
      links: [
        { name: "Datenschutzerklärung", route: "datenschutzerklärung" },
        { name: "Cookie-Einstellungen", route: "cookie-settings" },
        { name: "Impressum", route: "impressum" },
      ],
    },
    {
      title: "Kontakt",
      links: [{ name: "example@email.com", route: "mailto:example@email.com", icon: "email" }],
    },
  ];
</script>

<footer
  class="content-grid bg-secondary-700 border-secondary-300 border-t-4 text-white/50 dark:bg-background-300 dark:border-border-400"
>
  <div class="breakout w-full items-center py-12 lg:flex lg:py-20">
    <div
      class="border-secondary-500 grid grid-cols-1 content-start gap-8 border-b pb-12 lg:h-full lg:border-r lg:border-b-0 lg:py-4 lg:pr-12 dark:border-border-400"
    >
      <div class="grid grid-cols-[max-content_minmax(0,1fr)] items-center gap-4">
        <a href="/">
          <img src={logo} alt="Logo" class="w-14 shrink-0" />
        </a>

        <div>
          <p class="font-heading text-primary-200 text-2xl font-medium">Michael Ende</p>
          <p class="text-sm uppercase">Die Unendliche Geschichte</p>
        </div>
      </div>

      <p>
        Lorem ipsum dolor sit amet consectetur adipiscing elit Ut et massa mi. Aliquam in hendrerit
        urna.
      </p>
    </div>

    <div class="columns flex w-full grow flex-wrap justify-between gap-16 pt-12 lg:pt-0 lg:pl-12">
      {#each columns as column (column.title)}
        <div class="column">
          <h3
            class="column-name font-heading text-white border-secondary-400 w-fit border-b dark:border-border-400"
          >
            {column.title}
          </h3>
          <ul class="grid grid-cols-1 gap-3">
            {#each column.links as link (link.route)}
              <li class="flex w-fit items-center text-lg">
                {#if link.icon === "email"}
                  <a href={link.route} aria-label={`Kontakt über ${link.name}`}>
                    <svg
                      class="text-secondary-400 hover:text-secondary-300 mr-2 inline-block h-5 max-w-5 shrink-0 transition-colors dark:text-secondary-300 dark:hover:text-secondary-400"
                      viewBox="0 80 512 352"
                      aria-hidden="true"
                    >
                      <polygon points="339.392 258.624 512 367.744 512 144.896"></polygon>
                      <polygon points="0 144.896 0 367.744 172.608 258.624"></polygon>
                      <path
                        d="M480 80H32C16.032 80 3.36 91.904.96 107.232L256 275.264l255.04-168.032C508.64 91.904 495.968 80 480 80z"
                      ></path>
                      <path
                        d="m310.08 277.952-45.28 29.824c-2.688 1.76-5.728 2.624-8.8 2.624s-6.112-.864-8.8-2.624l-45.28-29.856L1.024 404.992C3.488 420.192 16.096 432 32 432h448c15.904 0 28.512-11.808 30.976-27.008L310.08 277.952z"
                      ></path>
                    </svg>
                  </a>
                {/if}
                <a href={link.route} class="transition-colors hover:text-white">
                  {link.name}
                </a>
              </li>
            {/each}
          </ul>
        </div>
      {/each}
    </div>
  </div>

  <div class="bottom bg-secondary-800 dark:bg-background-400 fill-width px-8 py-5 text-center">
    <p class="mb-2">Copyright © 2026 Michael Ende</p>
  </div>
</footer>

<style>
  .column-name {
    padding-bottom: 10px;
    margin-bottom: 1rem;
    font-size: 1.125rem;
    font-weight: 500;
    letter-spacing: 1.8px;
    text-transform: uppercase;
  }
</style>
