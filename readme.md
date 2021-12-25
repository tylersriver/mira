# Mira Views Component
A Tiny view renderer

# Usage

## Basic
```php
// assumes a __DIR__/path/to/dir/view.phtml file exists

$mira = new Mira\Mira(__DIR__ . '/path/to/views');

// title will be injected as variable $title
$page = $mira->render('view', ['title' => 'title']);

// Display content however you want
echo $page;
```

## Insert Sections in the Template
```php
<div> 
    <?php
        // render a section in the view
        $this->insert("section"); 
    ?>
</div>
```

## Escape Injected parameters
```php
<div>
    <?php echo $this->e($title); ?>
</div>
```