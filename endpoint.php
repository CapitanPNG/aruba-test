<?php

    # Returns [bool]
    function is_prime (int $number)
    {
        // (Setting the value)
        $divisors = [];

        for ( $i = 1; $i <= $number; $i++ )
        {// Iterating each index
            if ( $number % $i === 0 )
            {// (Number is divisable)
                // (Appending the value)
                $divisors[] = $i;
            }
        }



        if ( count($divisors) === 2 )
        {// (There are only two divisors)
            if ( $divisors[0] === 1 && $divisors[1] === $number )
            {// (Number is a Prime)
                // Returning the value
                return true;
            }
        }



        // Returning the value
        return false;
    }



    # Returns [int|false]
    function calc_prev_prime_OLD (int $number, ?array &$primes = null)
    {
        // (Setting the value)
        $target = false;



        // (Setting the value)
        $diff = 1;



        // (Setting the value)
        $primes = [];

        for ( $i = 1; $i <= $number; $i++ )
        {// Iterating each index
            if ( is_prime( $i ) )
            {// (Number is a Prime)
                // (Appending the value)
                $primes[] = $i;



                if ( $number !== $i && $number - $i <= $diff )
                {// Match OK
                    // (Getting the value)
                    $target = $i;
                }



                // (Getting the value)
                $diff = $number - $i;
            }
        }



        // Returning the value
        return $target;
    }

    # Returns [int|false]
    function calc_prev_prime (int $number, ?array &$primes = null)
    {
        // (Setting the value)
        $primes = [];



        if ( $number <= 2 ) return false;



        // (Getting the value)
        $target = $number - 1;

        while ( !is_prime($target) )
        {// Processing each entry
            // (Decrementing the value)
            $target -= 1;
        }



        for ( $i = 0; $i < $number; $i++ )
        {// Iterating each entry
            if ( is_prime($i) )
            {// (Number is a Prime)
                // (Appending the value)
                $primes[] = $i;
            }
        }



        // Returning the value
        return $target;
    }

    # Returns [int|false]
    function calc_next_prime (int $number, ?array &$primes = null)
    {
        // (Setting the value)
        $primes = [];



        // (Getting the value)
        $target = $number + 1;

        while ( !is_prime($target) )
        {// Processing each entry
            // (Decrementing the value)
            $target += 1;
        }



        for ( $i = $number; $i <= $target; $i++ )
        {// Iterating each entry
            if ( is_prime($i) )
            {// (Number is a Prime)
                // (Appending the value)
                $primes[] = $i;
            }
        }



        // Returning the value
        return $target;
    }

    # Returns [array<int>]
    function calc_primes_between (int $min, int $max)
    {
        // (Setting the value)
        $primes = [];

        for ( $i = $min + 1; $i < $max; $i++ )
        {// Iterating each index
            if ( is_prime($i) )
            {// (Number is a Prime)
                // (Appending the value)
                $primes[] = $i;
            }
        }



        // Returning the value
        return $primes;
    }



    class Test
    {
        # Returns [array<assoc>]
        public static function calc_prev_prime (int $min = 0, int $max = 100)
        {
            // (Setting the value)
            $tests = [];

            for ($i = $min; $i < $max; $i++)
            {// Iterating each entry
                // (Calculating the previous prime)
                $target = calc_prev_prime( $i, $primes );

                // (Appending the value)
                $tests[] =
                [
                    'sample' => $i,

                    'primes' => $primes,
                    'target' => $target
                ]
                ;
            }



            // Returning the value
            return $tests;
        }

        # Returns [array<assoc>]
        public static function calc_next_prime (int $min = 0, int $max = 100)
        {
            // (Setting the value)
            $tests = [];

            for ($i = $min; $i < $max; $i++)
            {// Iterating each entry
                // (Calculating the previous prime)
                $target = calc_next_prime( $i, $primes );

                // (Appending the value)
                $tests[] =
                [
                    'sample' => $i,

                    'primes' => $primes,
                    'target' => $target
                ]
                ;
            }



            // Returning the value
            return $tests;
        }

        # Returns [array<assoc>]
        public static function calc_primes_between ()
        {
            // (Setting the value)
            $tests =
            [
                [
                    'min' => 2,
                    'max' => 10
                ],

                [
                    'min' => 20,
                    'max' => 50
                ],

                [
                    'min' => 50,
                    'max' => 300
                ]
            ]
            ;

            foreach ($tests as &$test)
            {// Processing each entry
                // (Getting the value)
                $test['primes'] = calc_primes_between( $test['min'], $test['max'] );
            }



            // Returning the value
            return $tests;
        }
    }



    // (Setting the header)
    header('Content-Type: application/json');



    switch ( '/'.$_GET['route'] )
    {
        case '/prevPrime':
            // (Getting the value)
            $target = calc_prev_prime( $_GET['x'], $primes );

            // Printing the value
            echo json_encode( $target );
        break;

        case '/nextPrime':
            // (Getting the value)
            $target = calc_prev_prime( $_GET['x'], $primes );

            // Printing the value
            echo json_encode( $target );
        break;

        case '/primesBetween':
            // (Getting the value)
            $primes = calc_primes_between( $_GET['x'], $_GET['y'] );

            // Printing the value
            echo json_encode( $primes );
        break;



        case '/test/prevPrime':
            // Printing the value
            echo json_encode( Test::calc_prev_prime() );
        break;

        case '/test/nextPrime':
            // Printing the value
            echo json_encode( Test::calc_next_prime() );
        break;

        case '/test/primesBetween':
            // Printing the value
            echo json_encode( Test::calc_primes_between() );
        break;
    }

?>