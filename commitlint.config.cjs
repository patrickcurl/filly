// eslint-disable-next-line no-undef
module.exports = {
  extends: [
    '@commitlint/config-conventional'
  ],
  /*
   * Resolve and load @commitlint/format from node_modules.
   * Referenced package must be installed
   */
  formatter: '@commitlint/format',
  rules: {
    'body-max-line-length': [2, 'always', 200],
    'header-max-length': [2, 'always', 100]
  }
}
