# MedBrief CoreBundle
This is a Symfony Bundle compatible with Symfony 2.8+ which provides several features which are commonly required in Symfony projects.

## Installation

### Step 1: Add the following to the "require" section of composer.json

```
"medbrief/core-bundle": "dev-master"
```

### Step 2: Enable the bundle

Enable the bundle in the kernel:

``` php
<?php
// app/AppKernel.php

public function registerBundles()
{
    $bundles = array(
        // ...
        new MedBrief\CoreBundle\SideclickCoreBundle(),
    );
}
```
### Step 3: Install additional Bundles

This Bundle requires that other bundles be installed and configured, these are:
- https://github.com/dustin10/VichUploaderBundle
- https://github.com/FriendsOfSymfony/FOSMessageBundle (Note that when installing this, you do not need to perform the steps named "Step 2 - Setting up your user class" and "Step 3 - Set up FOSMessageBundle's models", this has already been done in the ScCoreBundle

#### Step 3.1 Configuring FOSMessageBundle

When configuring FOSMessageBundle, start with this:

``` yaml
fos_message:
    db_driver: orm
    thread_class: Sc\CoreBundle\Entity\Thread
    message_class: Sc\CoreBundle\Entity\Message
```

You will need to install and configure these before being able to use this Bundle.

## Features

### 1. Entity Helpers

Entity helper classes should be defined in the /Entity/Helper directory, here is the basic structure of an Entity Helper class for an entity named 'User':

``` php
<?php
//Sideclick\CoreBundle\Entity\Helper\UserHelper.php

namespace Sideclick\CoreBundle\Entity\Helper;

use Sideclick\CoreBundle\Entity\Helper\HelperAbstract;
use Sideclick\CoreBundle\Entity\User;

class UserHelper extends HelperAbstract
{
    protected $_user;

    public function setUser(User $user)
    {
        $this->_user = $user;
    }
    
}
```

There is a service named sc_core.entity_helper_factory which makes it easy to get an instance of an Entity Helper for an object, for example, in your controller you could do:

``` php
$userHelper = $this->get('sc_core.entity_helper_factory')->getEntityHelper($user);
```

Also, there is a twig function to get a helper in your templates:

``` twig
get_entity_helper(user)
```



More documentation to come...
