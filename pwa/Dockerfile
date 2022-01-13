# https://docs.docker.com/develop/develop-images/multistage-build/#stop-at-a-specific-build-stage
# https://docs.docker.com/compose/compose-file/#target


# https://docs.docker.com/engine/reference/builder/#understand-how-arg-and-from-interact
ARG NODE_VERSION=16

# "common" stage
FROM node:${NODE_VERSION}-alpine AS api_platform_pwa_common

EXPOSE 3000

WORKDIR /usr/src/pwa

# prevent the reinstallation of node modules at every changes in the source code
COPY package.json ./
COPY yarn.lock ./


COPY . ./

RUN yarn

#VOLUME /usr/src/pwa/node_modules
# ENV PATH /usr/src/pwa/node_modules/.bin:$PATH


# "development" stage
# depends on the "common" stage above
FROM api_platform_pwa_common AS api_platform_pwa_dev

RUN yarn global add --dev @testing-library/react
# RUN yarn global add react-i18next i18next
# RUN yarn global add react-router-dom
# RUN yarn global add react-transition-group

CMD ["yarn", "start"]


# "build" stage
# depends on the "common" stage above
FROM api_platform_pwa_common AS api_platform_pwa_prod

ENV NODE_ENV production
ARG NEXT_PUBLIC_ENTRYPOINT

RUN set -eux; \
	yarn build

CMD ["yarn", "start"]
