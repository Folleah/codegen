### Use this library for simple generation verification codes.

**Installation:**

Add to `composer.json`:
```
"folleah/codegen": "^1.0"
```
and run `composer update`

**Using:**
```$php
/**
 * first param is code length, second param is easy mode flag
/*
$generator = new Generator(4, true);
echo $generator->generate();
```

Generated code without `easy mode`: 5142

Generated code with `easy mode`: 5521
