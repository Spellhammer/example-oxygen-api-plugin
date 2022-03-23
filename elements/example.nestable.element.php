<?php

// This element is a work in progress and is currently fairly identical to the normal example element, aside from
// nesting being enabled and the render function outputting $content in a 4.0 compatible manner.

class ExampleNestableElement extends OxyEl {

    function init() {
        // Do some initial things here.
        $this->enableNesting();
    }

    function afterInit() {
        // Do things after init, like remove apply params button and remove the add button.
        $this->removeApplyParamsButton();
        // $this->removeAddButton();
    }

    function name() {
        return 'My Nestable Element';
    }
    
    function slug() {
        return "my-nestable-element";
    }

    function icon() {
        // Path to icon here.
    }

    function button_place() {
        // return "interactive";
    }

    function button_priority() {
        // return 9;
    }

    /* Uncomment this to have a a predetermined basic structure inserted inside your nestable element when it's added. */
    /*
    function prefilledComponentStructure() {
        return
            array(
                array(
                    "ct_div_block" => array(
                        array(
                            "ct_div_block" => array(
                                "ct_headline",
                                "ct_text_block",
                                "ct_image",
                            )
                        ),
                        array(
                            "ct_div_block" => array(
                                "ct_headline",
                                "ct_text_block",
                                "ct_image",
                            )
                        ),
                        array(
                            "ct_div_block" => array(
                                "ct_headline",
                                "ct_text_block",
                                "ct_image",
                            )
                        ),
                    )
                ),
                "ct_headline"
            );
    }
    */

    
    function render($options, $defaults, $content) {

        // $options['tag'] = 'h1';
        $options['text'] = 'this is my title';
        // Output here.

        // This conditional allows backward compatibility with versions prior to Oxygen 4.0
        // and allows the element to work with JSON in Oxygen 4.0
        if ( function_exists('do_oxygen_elements') ) {
            ?>
            <!-- content renders here!! -->
                    <div class="container">
                        <<?php echo $options['tag'];?> class="title"><?php echo $options['text']; ?></<?php echo $options['tag'];?>>
                        <div class="content">
                            <?php
                                echo do_oxygen_elements($content);          
                            ?>
            <!-- I want content here!! -->
                        </div>
                    </div>
            
                    <?php
        }
        else {
            ?>
            <!-- content renders here!! -->
            <div class="container">
                <<?php echo $options['tag'];?> class="title"><?php echo $options['tetx']; ?></<?php echo $options['tag'];?>>
                <div class="content">
                    <?php
                        echo do_shortcode($content);          
                    ?>
            <!-- I want content here!! -->
                </div>
            </div>
    
            <?php
        }

    }

    function controls() {

        // We can create control sections:
        $controlSection = $this->addControlSection("section_slug", __("Section Name"), "assets/icon.png", $this);

        // Later, we can reference $controlSection (or whatever you named your section) and add controls to it
        // If you want to add controls to the primary tab directly, you can use $this instead of $controlSection
        
        // Style controls are mapped directly to a selector and a property, so they're used for simple CSS controls
        $controlSection->addStyleControl(
            array( 
                "name" => __('Control Name'),
                "selector" => ".some-selector > child",
                "property" => 'background-color',
                "control_type" => "colorpicker",
                // "unit" => "px" // We don't need to declare a unit since this field is a color picker, but it's useful to do so for measurebox fields
            )
        );

        // Option controls can be accessed in the render() function via $options['field_slug']
        $controlSection->addOptionControl(
			array(
                "type" => 'textfield', // types: textfield, dropdown, checkbox, buttons-list, measurebox, slider-measurebox, colorpicker, icon_finder, mediaurl
				"name" => 'Field Name',
				"slug" => 'field_slug'
            )
        );

        // If we want to output some CSS based on the value of an Option control, we can do this instead:
        $my_control = $controlSection->addOptionControl(
            array(
                "type" => 'buttons-list', // types: textfield, dropdown, checkbox, buttons-list, measurebox, slider-measurebox, colorpicker, icon_finder, mediaurl
				"name" => 'Field Name Two',
				"slug" => 'field_slug_two'
            )
        );

        // For controls with multiple values, like dropdowns or button lists, you can define them like this:
        $my_control->setValue(
            array(
                'value' => 'Label',
                'value2' => 'Label2'
            )
        );

        // You can define the default:
        $my_control->setDefaultValue('value');

        // You can then conditionally output some CSS depending on the chosen value:
        $my_control->setValueCSS(
            array(
                'value' => '.my-example-class { background-color: purple }',
                'value2' => '.my-example-class { background-color: red }'
            )
        );

        // It's also usually a good idea to whitelist these types of controls for breakpoints:
        $my_control->whitelist();

        // We can also make our element rebuild when a control's value is changed:
        $my_control->rebuildElementOnChange();
        
        // Instead of building out every control ourselves, there are also presets available for commonly needed controls:
        $this->borderSection(
            __("Border Section Name"),
            '.selector',
            $this
        );

        $this->typographySection(
            __("Typography Section Name"),
            '.selector',
            $this
        );

        $this->boxShadowSection(
            __("Shadow Section Name"),
            '.selector',
            $this
        );

        // The flex preset can only be used in a section, and doesn't have accept a name argument
        $controlSection->flex(
            '.selector',
            $this
        );

    }

    function defaultCSS() {

        //return file_get_contents(__DIR__.'/'.basename(__FILE__, '.php').'.css');
 
    }
    
}

new ExampleNestableElement();
