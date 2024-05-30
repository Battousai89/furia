FROM denoland/deno:alpine-1.43.6

# The port that your application listens to.
EXPOSE 1993

USER deno

WORKDIR /var/www/furia-front

# Cache the dependencies as a layer (the following two steps are re-run only when deps.ts is modified).
# Ideally cache deps.ts will download and compile _all_ external files used in main.ts.
COPY ./frontend/deps.ts ./frontend/main.ts ./
RUN deno cache deps.ts

# Compile the main app so that it doesn't need to be compiled each startup/entry.
RUN deno cache main.ts

CMD ["run", "--allow-net", "main.ts"]