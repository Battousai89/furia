import { serve } from "aleph/server";
import react from "aleph/plugins/react";
import unocss from "aleph/plugins/unocss";
import config from "./unocss.config.ts";

serve({
  plugins: [
    react({ ssr: true }),
    unocss(config),
  ],
});
