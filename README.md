# Formjack

Formjack is a open source PHP library that helps you to build and validate custom forms with ease. Keep in mind that this library is still in heavy development stage which means that the API and their implementation could change slightly in the future (but we really try to avoid that as much as possible).

## Installation

Step 1: **Clone the repository**

```
$ git clone git@github.com:Slicejack/Formjack.git path/to/project/lib
```

Step 2: **Include Formjack.php**

```
<?php

include 'lib/Formjack/Formjack.php';
```

Step 3: **There is no third step :beers:**

## Basic usage

After you've successfully imported the Formjack library within your project you can start building your own custom forms. Here is an example that shows how you can use Formjack to build a fairly simple contact form.

```
<?php

include 'lib/Formjack/Formjack.php';

use Formjack\Form;
use Formjack\Field\TextField;
use Formjack\Field\EmailField;
use Formjack\Field\TextareaField;

$form = new Form('Contact_Form', array(
	new TextField(
		'first_name',
		array(
			'label' => 'First Name:'
		)
	),
	new TextField(
		'last_name',
		array(
			'label' => 'Last Name:'
		)
	),
	new EmailField(
		'email',
		array(
			'label' => 'Email:'
		)
	),
	new TextareaField(
		'message',
		array(
			'label' => 'Message:'
		)
	)
));
```

You can also add fields by calling the **addField** method. That method can also be chained which allows you to add multiple fields in a row.

```
<?php

// ...

$form
	->addField(new TextField( /* ... */ ))
	->addField(new TextField( /* ... */ ))
;
```

## Validation rules

Formjack library allows you to validate the form data as well, so let's add few validation rules to our form fields.

```
<?php

// ...

use Formjack\Rule\NotEmpty;
use Formjack\Rule\Email;

$form = new Form('Contact_Form', array(
	new TextField(
		'first_name',
		array(
			'label' => 'First Name:',
			'rules' => array(
				new NotEmpty('Please enter your first name.')
			)
		)
	),
	new TextField(
		'last_name',
		array(
			'label' => 'Last Name:',
			'rules' => array(
				new NotEmpty('Please enter your last name.')
			)
		)
	),
	new EmailField(
		'email',
		array(
			'label' => 'Email:',
			'rules' => array(
				new NotEmpty('Please enter your email.'),
				new Email('Please enter a valid email.')
			)
		)
	),
	new TextareaField(
		'message',
		array(
			'label' => 'Message:'
		)
	)
));
```

## Rendering

Let's now render the form within a view file. Keep in mind that the view file needs to be aware of the form instance you've just created. Implementation of that may vary depending on what platform or framework you are using.

```
<form name="contact" action="handler.php" method="POST">
	<?php $form->render(); ?>
	<input type="submit" value="Submit" />
</form>
```

You can also choose to render each field separately.

```
<form name="contact" action="handler.php" method="POST">
	<div class="colum-left">
		<?php $form->renderField('first_name'); ?>
		<?php $form->renderField('last_name'); ?>
		<?php $form->renderField('email'); ?>
	</div>
	<div class="column-right">
		<?php $form->renderField('message'); ?>
		<input type="submit" value="Submit" />
	</div>
</form>
```

## Handling submissions and data validation

Formjack doesn't bind data automatically so you will need to write your own form submission handler. Here is a working example:

```
<?php

// ...

if (
	$_SERVER['REQUEST_METHOD'] == 'POST' &&
	isset($_POST[$form->getName()])
) {
	$form->bind($_POST[$form->getName()]);
	if ($form->isValid()) {
		// Success
	} else {
		// Fail
	}
}
```

Formjack also provides you with few methods that you can use to fetch the validation errors and form data as well.

```
<?php

// ...

// Get validation errors
$errors = $form->getErrors();

// Get form data
$data = $form->getData();
```

## Documentation

If you wish to learn more about Formjack and stuff that you can make with it? Read on!

- [Fields](https://github.com/Slicejack/Formjack/wiki/Fields) - Learn more about Formjack fields and how to use them
- [Validation](https://github.com/Slicejack/Formjack/wiki/Validation) - List of all available validation rules
- [Layouts](https://github.com/Slicejack/Formjack/wiki/Layouts) - Customize the looks and feels of a form

## License

All contents of this package are licensed under the [MIT license](https://github.com/Slicejack/Formjack/blob/master/LICENSE).
