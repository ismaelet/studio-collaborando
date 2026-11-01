import "../css/app.css";
import.meta.glob(["../images/**"]);

import { createInertiaApp, type ResolvedComponent } from "@inertiajs/svelte";

createInertiaApp({
  resolve: (name) => {
    const pages = import.meta.glob<ResolvedComponent>("./pages/**/*.svelte");
    const page = pages[`./pages/${name}.svelte`];

    if (!page) {
      throw new Error(`Page not found: ${name}`);
    }

    return page();
  },
});
