module.exports = {
  rootDir: ".",
  moduleNameMapper: {
    "@wordpress\\/(block-serialization-spec-parser|is-shallow-equal)$": "packages/$1",
    "@wordpress\\/([a-z0-9-]+)$": "packages/$1/src"
  },
  preset: "@wordpress/jest-preset-default",
  setupFiles: [
    "<rootDir>/node_modules/regenerator-runtime/runtime",
    "./setupJest.js"
  ],
  testURL: "http://localhost",
  testPathIgnorePatterns: [
    "/node_modules/",
    "/test/e2e",
    "<rootDir>/.*/build/",
    "<rootDir>/.*/build-module/"
  ],
  transformIgnorePatterns: [
    "node_modules/(?!(simple-html-tokenizer)/)"
  ],
  browser: true,
  moduleDirectories: ['<rootDir>/src', '<rootDir>/node_modules'],
  // testMatch: ['<rootDir>/tests/**/*.spec.js'],
  // testPathIgnorePatterns: ['/node_modules/'],
  // transform: {
  //   '^.+\\.jsx?$': '<rootDir>/babel-transform.js',
  // },
  verbose: true,
} 


