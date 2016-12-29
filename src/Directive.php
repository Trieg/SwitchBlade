<?php
namespace AwkwardIdeas\SwitchBlade;


class Directive{
    public function __construct()
    {
        Blade::directive('htmlAttribute', function ($expression) {
            //begin with [A-Za-z]
            //allowed after first [A-Za-z][0-9]-_:.
            $pattern='/[^A-Za-z][^A-Za-z0-9\-_:\.]/';
            $replacement="";
            return "<?php echo preg_replace($pattern, $replacement, $expression); ?>";
        });

        /*
         * Laravel dd() function.
         *
         * Usage: @dd($variableToDump)
         */
        Blade::directive('dd', function ($expression) {
            return "<?php dd(with{$expression}); ?>";
        });

        /*
         * php explode() function.
         *
         * Usage: @explode($delimiter, $string)
         */
        Blade::directive('explode', function ($argumentString) {
            list($delimiter, $string) = $this->getArguments($argumentString);

            return "<?php echo explode({$delimiter}, {$string}); ?>";
        });

        /*
         * php implode() function.
         *
         * Usage: @implode($delimiter, $array)
         */
        Blade::directive('implode', function ($argumentString) {
            list($delimiter, $array) = $this->getArguments($argumentString);

            return "<?php echo implode({$delimiter}, {$array}); ?>";
        });

        /*
         * php var_dump() function.
         *
         * Usage: @var_dump($variableToDump)
         */
        Blade::directive('varDump', function ($expression) {
            return "<?php var_dump(with{$expression}); ?>";
        });

        /*
         * Set variable.
         *
         * Usage: @set($name, value)
         */
        Blade::directive('set', function ($argumentString) {
            list($name, $value) = $this->getArguments($argumentString);

            return "<?php {$name} = {$value}; ?>";
        });
    }
}