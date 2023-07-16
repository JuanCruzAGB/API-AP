import Vue from 'vue';
import Vuex from 'vuex';

import actions from "./actions.js";
import getters from "./getters.js";
import mutations from "./mutations.js";

Vue.use(Vuex);

export default new Vuex.Store({
  state: {
    auth,
    env,
    media: 'mobile',
    url: {
      auth: auth_url,
      catalog: catalog_url,
      current: url,
      development: development_url,
      local: local_url,
      panel: panel_url,
    },
    width: 0,
  },
  actions,
  getters,
  mutations,
});