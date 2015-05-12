
            <ul class="nav navbar-nav">
              @foreach($system as $item)
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" role="button" aria-expanded="false"><img src="{{ $item->image }}" class="size20" alt="icon"> {{ $item->name }} <span class="caret"></span></a>
                <ul class="dropdown-menu" role="menu">
                  @foreach(explode(PHP_EOL,$item->id_category) as $category)
                      @if(is_numeric($category))
                          <li><a href="{{{ URL::to('admin/softwares/category/'.$item->id.'/'.$category) }}}"><img src="{{ Category::find($category)->image }}" class="size20" alt="icon">  {{ Category::find($category)->name }}</a></li>
                      @endif
                  @endforeach
                  <li class="divider"></li>
                </ul>
              </li>
              @endforeach
            </ul>

<script type="text/javascript">
 (function ($, window, undefined) {
    var $allDropdowns = $();

    $.fn.dropdownHover = function (options) {
        if('ontouchstart' in document) return this; 


        $allDropdowns = $allDropdowns.add(this.parent());

        return this.each(function () {
            var $this = $(this),
                $parent = $this.parent(),
                defaults = {
                    delay: 500,
                    hoverDelay: 0,
                    instantlyCloseOthers: true
                },
                data = {
                    delay: $(this).data('delay'),
                    hoverDelay: $(this).data('hover-delay'),
                    instantlyCloseOthers: $(this).data('close-others')
                },
                showEvent   = 'show.bs.dropdown',
                hideEvent   = 'hide.bs.dropdown',
                settings = $.extend(true, {}, defaults, options, data),
                timeout, timeoutHover;

            $parent.hover(function (event) {
                if(!$parent.hasClass('open') && !$this.is(event.target)) {
                    return true;
                }

                openDropdown(event);
            }, function () {
                window.clearTimeout(timeoutHover)
                timeout = window.setTimeout(function () {
                    $this.attr('aria-expanded', 'false');
                    $parent.removeClass('open');
                    $this.trigger(hideEvent);
                }, settings.delay);
            });

            $this.hover(function (event) {
                if(!$parent.hasClass('open') && !$parent.is(event.target)) {
                    return true;
                }

                openDropdown(event);
            });

            $parent.find('.dropdown-submenu').each(function (){
                var $this = $(this);
                var subTimeout;
                $this.hover(function () {
                    window.clearTimeout(subTimeout);
                    $this.children('.dropdown-menu').show();
                    $this.siblings().children('.dropdown-menu').hide();
                }, function () {
                    var $submenu = $this.children('.dropdown-menu');
                    subTimeout = window.setTimeout(function () {
                        $submenu.hide();
                    }, settings.delay);
                });
            });

            function openDropdown(event) {
                window.clearTimeout(timeout);
                window.clearTimeout(timeoutHover);
                
                timeoutHover = window.setTimeout(function () {
                    $allDropdowns.find(':focus').blur();

                    if(settings.instantlyCloseOthers === true)
                        $allDropdowns.removeClass('open');
                    
                    window.clearTimeout(timeoutHover);
                    $this.attr('aria-expanded', 'true');
                    $parent.addClass('open');
                    $this.trigger(showEvent);
                }, settings.hoverDelay);
            }
        });
    };

    $(document).ready(function () {
        $('[data-hover="dropdown"]').dropdownHover();
    });
})(jQuery, window);

</script>
