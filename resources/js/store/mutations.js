export default {
  /**
   * * Set the auth value.
   * @param {object} state
   * @param {boolean} value
   */
  setAuth (state, value) {
    state.auth = value;
  },
  /**
   * * Set the media value.
   * @param {object} state
   * @param {string} value
   */
  setMedia (state, value) {
    state.media = value;
  },
  /**
   * * Set the width value.
   * @param {object} state
   * @param {string} value
   */
  setWidth (state, value) {
    state.width = value;
  },
};