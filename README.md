## Code Quality
`./vendor/bin/phpmd src ansi codesize,unusedcode,naming,controversial,design,cleancode`

## PHPUnit Watcher
`./vendor/bin/phpunit-watcher watch tests/ --testdox`

## Check Gherkin language support
`./vendor/bin/behat --story-syntax --lang=id`

## Init Behat
`./vendor/bin/behat --init`

## After make a *.feature file generate the rest of the test case
`./vendor/bin/behat --dry-run --append-snippets`

## Run Behat, make sure PHPUnit package already exists when you want to use assertions
`./vendor/bin/behat`
