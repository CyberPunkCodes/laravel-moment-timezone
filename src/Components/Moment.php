<?php

namespace CyberPunkCodes\MomentTimezone\Components;

use Carbon\Carbon;
use Closure;
use DateTimeInterface;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Moment extends Component
{
    /**
     * The datetime from Laravel
     *
     * @var CarbonInterface
     */
    public $date;

    /**
     * The format to convert the datetime to
     *
     * This format will change depending on whether or not you are using `local`, which uses
     * Moment. If you pass the `local` attribute to the modal, the format will need to match
     * the formatting for Moment. Otherwise, it will need to match PHP's formatting.
     *
     * @see https://www.php.net/manual/en/datetime.format.php
     * @see https://momentjs.com/docs/#/displaying/format/
     *
     * @var string
     * */
    public $format;

    /**
     * Whether or not to return as human readable (ie: 3 minutes ago)
     *
     * This only works with PHP's formatting and not when using `local`.
     *
     * @var bool
     * */
    public $human;

    /**
     * Whether or not to convert the datetime to the user's local timezone
     *
     * Moment and Moment Timezone are used only on this use case. When using `local`, you will
     * need to use Moment's formatting instead of PHP's.
     *
     * @see https://momentjs.com/docs/#/displaying/format/
     *
     * @var string|null
     */
    public $local;

    /**
     * Create a new component instance.
     */
    public function __construct(DateTimeInterface $date, string $format = 'm-d-Y g:i a', bool $human = false, $local = null)
    {
        $this->date   = Carbon::instance($date);
        $this->format = $format;
        $this->human  = $human;
        $this->local  = $local;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('moment::components.moment');
    }
}
