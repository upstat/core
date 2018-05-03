<?php

/*
 * This file is part of Flarum.
 *
 * (c) Toby Zerner <toby.zerner@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Flarum\Http\Middleware;

use Illuminate\Contracts\View\Factory as ViewFactory;
use Illuminate\Support\ViewErrorBag;
use Interop\Http\ServerMiddleware\DelegateInterface;
use Interop\Http\ServerMiddleware\MiddlewareInterface;
use Psr\Http\Message\ServerRequestInterface as Request;

/**
 * Inspired by Illuminate\View\Middleware\ShareErrorsFromSession.
 *
 * @author Taylor Otwell
 */
class ShareErrorsFromSession implements MiddlewareInterface
{
    /**
     * @var ViewFactory
     */
    protected $view;

    /**
     * @param ViewFactory $view
     */
    public function __construct(ViewFactory $view)
    {
        $this->view = $view;
    }

    public function process(Request $request, DelegateInterface $delegate)
    {
        $session = $request->getAttribute('session');

        // If the current session has an "errors" variable bound to it, we will share
        // its value with all view instances so the views can easily access errors
        // without having to bind. An empty bag is set when there aren't errors.
        $this->view->share(
            'errors', $session->get('errors', new ViewErrorBag)
        );

        // Putting the errors in the view for every view allows the developer to just
        // assume that some errors are always available, which is convenient since
        // they don't have to continually run checks for the presence of errors.

        $session->remove('errors');

        return $delegate->process($request);
    }
}
