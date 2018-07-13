/*
Copyright (c) 2018
[Master Script]
Theme Name : FORM BUILDER
Version    : 1.0
Author : MeloThemes
Email: melothemes@gmail.com
*/
/*jslint browser: true*/
/*global $, jQuery, alert*/
/*---------------------------------------------
Table of Contents
-----------------------------------------------
Pace Page Preloader
Datepicker
Magnific Video Popup
Progress Bar
Data Tables
Offcanvas Menu
------------------------------------------*/
$(document).ready(function () {
    "use strict";


    /* Datepicker */
    if ($('.datepicker').length) {
        $('.datepicker').datepicker();
    }
    if ($('.datepicker-embed').length) {
        $('.datepicker-embed').datepicker({
            todayHighlight: true
        });
    }


    /* Magnific Popup */
    if ($('.videopopUp').length) {
        $('.videopopUp').magnificPopup({
            type: 'iframe'
            , iframe: {
                markup: '<div class="mfp-iframe-scaler">' + '<div class="mfp-close"></div>' + '<iframe class="mfp-iframe" frameborder="0" allowfullscreen></iframe>' + '</div>', // HTML markup of popup, `mfp-close` will be replaced by the close button
                patterns: {
                    youtube: {
                        index: 'youtube.com/'
                        , id: 'v='
                        , src: 'https://www.youtube.com/embed/%id%'
                    }
                    , vimeo: {
                        index: 'vimeo.com/'
                        , id: '/'
                        , src: 'https://player.vimeo.com/video/%id%'
                    }
                    , gmaps: {
                        index: '//maps.google.'
                        , src: '%id%&output=embed'
                    }
                }
                , srcAction: 'iframe_src'
            }
        });
    }


    /* Datatables */
    if ($('.datatables').length) {
        var tableObj = $('.datatables').DataTable({
            language: {
                paginate: {
                    next: '<i class="fa fa-fw fa-angle-right">'
                    , previous: '<i class="fa fa-fw fa-angle-left">'
                }
                , "sLengthMenu": " _MENU_ "
            , }
            , "sDom": 'Rfrtlip'
        });
    }

    if ($('#left').length) {
    /* Offcanvas Menu */
    $('#left').offcanvas({
        modifiers: "left,overlay"
        , triggerButton: '.js-offcanvas-toggler'
        , onInit: function () {
            $(this).removeClass('is-hidden');
        }
    });
    $.fn.appendAround = function () {
        return this.each(function () {
            var $self = $(this)
                , att = "data-set"
                , $parent = $self.parent()
                , parent = $parent[0]
                , attval = $parent.attr(att)
                , $set = $("[" + att + "='" + attval + "']");

            function isHidden(elem) {
                return $(elem).css("display") === "none";
            }

            function appendToVisibleContainer() {
                if (isHidden(parent)) {
                    var found = 0;
                    $set.each(function () {
                        if (!isHidden(this) && !found) {
                            $self.appendTo(this);
                            found++;
                            parent = this;
                        }
                    });
                }
            }
            appendToVisibleContainer();
            $(window).on('bind', "resize", appendToVisibleContainer);
        });
    };
    $(".js-append-around").appendAround();
    }
});
