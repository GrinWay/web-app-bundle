Reference
------

### Abstract test cases

Extend your test classes to `automatically` use their tests

| Test case class                                                                                                           | It tests         |
|---------------------------------------------------------------------------------------------------------------------------|------------------|
| [AbstractWebAppTestCase](https://github.com/GrinWay/web-app-bundle/blob/main/tests/Functional/AbstractWebAppTestCase.php) | `All GET routes` |

#### Your `phpunit.xml.dist` must be like:

```
<extensions>
    <bootstrap class="Zenstruck\Foundry\PHPUnit\FoundryExtension"/>
    <bootstrap class="Zenstruck\Browser\Test\BrowserExtension"/>
</extensions>
```

> NOTE: You can add the `when@test: *when_dev` line (see below example)
> `AbstractWebAppTestCase::testExplicitlyDescribedGetMethodRoutesWithoutParametersRequestedSuccessfullyAndNoOutput`
> <br> will show a different error message when test was not passed for `dump()` or `echo`
> <br>but that's not essential if it's not important for you to see exactly when it was `dump()` or just `echo`,
`var_dump()`... don't write this line

Example:

```yaml
# "%kernel.project_dir%/config/packages/debug.yaml"

when@dev: &when_dev # STEP 1
    debug:
        # Forwards VarDumper Data clones to a centralized server allowing to inspect dumps on CLI or in your browser.
        # See the "server:dump" command to start a new server.
        dump_destination: "tcp://%env(VAR_DUMPER_SERVER)%"

# Don't need to write this line
# At any rate test AbstractWebAppTestCase::testExplicitlyDescribedGetMethodRoutesWithoutParametersRequestedSuccessfullyAndNoOutput
# will see any output
when@test: *when_dev # STEP 2
```
