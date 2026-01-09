

# maarsson/coding-standard

Centralized custom coding standards that can be applied across different projects.

This package provides shared code quality rulesets and a sync script that applies them to consumer projects in a predictable and consistent way.

Currently supported:
- [PHP Mess Detector (PHPMD)](https://phpmd.org/)

---

## Requirements

- PHP ^8.2
- Composer

---

## Installation

### 1. Package installation

Install the package as a development dependency in your project:

`composer require --dev maarsson/coding-standard`

---

### 2. Project configuration (required)

To ensure the coding standards are applied automatically, you must configure Composer scripts in the target project.

#### 2.1. Add a named sync script

In your project’s `composer.json` add:

```json
{
  "scripts": {
    "coding-standard:sync": [
      "vendor/bin/sync-coding-standards.php"
    ]
  }
}
```

#### 2.2. Run the sync script on install and update

Extend your project’s `composer.json` scripts section to include:

```json
{
  "scripts": {
    "coding-standard:sync": [
      "vendor/bin/sync-coding-standards.php"
    ],
    "post-install-cmd": [
      "@coding-standard:sync"
    ],
    "post-update-cmd": [
      "@coding-standard:sync"
    ]
  }
}
```

With this setup, the coding standards are applied automatically.

---

## When does it apply?

Once configured, the sync script runs automatically in the following cases:

Automatic execution:
- After composer install
- After composer update
- During CI pipelines that run composer install or composer update

Manual execution:

- You can also apply the coding standards manually at any time:

    `composer coding-standard:sync` (preferred)

    or:

    `./vendor/bin/sync-coding-standards.php` (direct execution)

---

## What does the sync script do?

The sync script copies shared ruleset files from the package into the project root.

Currently applied files:
- `phpmd.xml`

### Overwrite behavior

The sync process uses an always overwrite strategy:

- If rulesets already exist in the project root, they will be replaced
- This guarantees all projects use the exact same ruleset

This behavior is intentional and ensures consistency across projects. If you need to customize rules per project, fork this repository or manage overrides outside of this package.

---

## Using PHPMD with the installed ruleset

After the sync script runs, `phpmd.xml` will exist in your project root, but you need to install the PHPMD itself:

`composer require --dev phpmd/phpmd`

Then run the PHPMD check like this:

`./vendor/bin/phpmd . ansi phpmd.xml --suffixes=php`

---

## Troubleshooting

***Source file not found***

This typically means:
- the package is not installed correctly
- Composer install/update did not complete successfully

Try:
```sh
composer install
composer coding-standard:sync -vvv
```

***Sync script not executable***

Ensure your environment supports running scripts from vendor/bin and that file permissions are preserved.

---

## License

[MIT](LICENSE)
