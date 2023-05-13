export default {
  /**
   * * Resize the application.
   */
  resize ({ commit, }) {
    let media = 'mobile';

    let width = window.innerWidth;

    if (width >= 1024) media = 'desktop';

    else if (width >= 768) media = 'tablet';

    commit('setMedia', media);

    commit('setWidth', width);
  },
};