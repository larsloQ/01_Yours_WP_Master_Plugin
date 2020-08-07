Testing Block with JEST

test files need to be names like so xxxx.test.js

> run a test / test like so:
npm  test  WHT.test.js 

Config Files:
<HOME>/setupJest.js
see >package.json


See here/test/WHT.test.js


# how is jest bootstrapped in Gutenberg

1. package json:
1.a packages
    "@wordpress/e2e-test-utils": "file:packages/e2e-test-utils",
    "@wordpress/e2e-tests": "file:packages/e2e-tests",
    "@wordpress/jest-console": "file:packages/jest-console",
    "@wordpress/jest-preset-default": "file:packages/jest-preset-default",
    "@wordpress/jest-puppeteer-axe": "file:packages/jest-puppeteer-axe",
    "eslint-plugin-jest": "21.5.0",
    "enzyme": "3.7.0",
1.b Script for Unit-Test
  "test-unit": "wp-scripts test-unit-js --config test/unit/jest.config.json",
  this script is (test-unit-js) located in **packages/scripts/scripts/test-unit-jest** and the config file
  at **wp-scripts test-unit-js**

packages/scripts/scripts/test-unit-jest