Zf1WrapperBundle
================

## Introduction 

The Zf1WrapperBundle is a Symfony 2 bundle for wrapping a Zend Framework 1 application.
It can be used to refactor parts of your legacy code to Symfony 2.


## Installation

### Composer ###
Add the following to your composer.json:
```
    "require": {
        "skrepr/zf1wrapperbundle":  "dev-master"
    }
```

## Configuration ##

### 1. config.yml ###
You need to configure is the location of your ZF1 bootstrap file (e.g. index.php).
Add the following to your config.yml:
```
parameters:

    #Zf1WrapperBundle
    zf1wrapper_bootstrap_path: ../web/index.php
```

### 2. routing.yml
The bundle uses a catch-all route which you have to add to your routing.yml:
```
zf1_wrapper:
    resource: "@Zf1WrapperBundle/Resources/config/routing.yml"
    prefix:   /
```

### 3. AppKernel.php ###
Add the following to your app/AppKernel.php to enable the bundle

```
    public function registerBundles()
    {
        return array(
            // ...
            new MainlyCode\Zf1WrapperBundle\Zf1WrapperBundle(),
        );
    }

```

