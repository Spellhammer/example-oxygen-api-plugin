# example-oxygen-api-plugin

This repository provides the boilerplate used to create custom API elements in [Oxygen Builder](https://oxygenbuilder.com/). Download and install this repository as a WordPress plugin to add new elements to Oxygen. 

## Usage

| Example                       | Description                |
| :---------------------------- | :------------------------- |
| main                          | The default example.       |
| [card](elements/card)         | Create a card element.     |
| [nestable](elements/nestable) | Create a nestable element. |

This [example](elements/main) creates an example element. Adjust the code from any example to create your own elements!

### CSS

Create a [`css`](elements/card/my.card.element.css) file with custom css.

### PHP

Create a [`php`](elements/main/example.element.php) file with a class that `extends OxyEl` and implement the functions located in [`example.element.php`](elements/main/example.element.php). Be sure to instantiate a `new` instance of the created `class();`.

## Documentation

The documentation for custom elements is coming soon. For more information, view [Building New Elements For Oxygen Using The Elements API](https://youtu.be/GB4npYmSrP8).

