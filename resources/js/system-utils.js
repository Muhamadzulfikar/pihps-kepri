/**
 * @type {{
 *   ready: function(function(): void): void,
 *   status: function(Response): Promise<Response>,
 *   json: function(Response): Promise<any>,
 *   error: function(Error): void,
 *   appendOptions: function(Object, string): void,
 *   getAndAppend: function(string, string, string, string): void,
 *   getAndReplace: function(string, Array<string>, string, string): void,
 *   ml: function(string, ?Object, ?(string|Node|Array<string|Node>)): Element,
 *   nester: function(Element, string|Node|Array<string|Node>): Element
 * }}
 */
window.system = {
    /**
     * A function to execute a callback when the DOM is fully loaded.
     * @param callback
     */
    ready: (callback) => {
        if (document.readyState !== "loading") {
            callback();
        } else {
            document.addEventListener("DOMContentLoaded", callback);
        }
    },

    /**
     * Handles HTTP response statuses, resolving successful responses and rejecting errors with custom error messages.
     * @param response
     * @returns {Promise<Awaited<*>>|Promise<Result<RootNode>>|Promise<Result<Root>>|Promise<any>}
     */
    status: function (response) {
        if (response.status >= 200 && response.status < 300) {
            return Promise.resolve(response);
        } else {
            return response.json()   // response.json returns a promise, we chose to do nothing with its
                .then((json) => { // conclusion
                    let $error = json.exception;
                    if (json.message !== "") {
                        if (typeof json.data !== "undefined") {
                            if (json.data.message !== "") {
                                $error = json.data.message;
                            } else {
                                $error = json.message;
                            }
                        } else {
                            $error = json.message;
                        }
                    } else {
                        $error = json.message;
                    }
                    throw new Error($error);
                })
                .catch((error) => {
                    return Promise.reject(error);
                });
        }
    },

    /**
     * A simple wrapper to parse JSON responses.
     * @param response
     * @returns {*}
     */
    json: function (response) {
        return response.json();
    },

    /**
     * Displays error messages using a SweetAlert2 popup
     * @param error
     */
    error: function (error) {
        Swal.fire({
            title: "Server Error",
            text: error.toString(),
            icon: 'error'
        }).then(r => {
        });
    },

    /**
     * Adds options to a select element.
     * @param data
     * @param target
     */
    appendOptions: (data, target) => {
        $("[name='" + target + "']").append($('<option>', {
            value: '',
            text: '-'
        }));
        $.each(data, function (key, val) {
            $("[name='" + target + "']").append($('<option>', {
                value: key,
                text: val
            }));
        });
    },

    /**
     * Fetches data from a URL and appends it to a select element.
     * @param source
     * @param target
     * @param key
     * @param url
     */
    getAndAppend: (source, target, key, url) => {
        $("[name='" + target + "'] option").each(function () {
            $(this).remove();
        });

        $.get('/' + url + '/find?' + key + '=' + $("[name='" + source + "']").val())
            .done(function (result) {
                system.appendOptions(result, target);
            });
    },

    /**
     * Fetches data and updates multiple form fields based on the response.
     * @param source
     * @param target
     * @param key
     * @param url
     */
    getAndReplace: (source, target, key, url) => {
        $.get('/' + url + '/find?' + key + '=' + $("[name='" + source + "']").val())
            .done(function (result) {
                $.each(result.tests, function (index, val) {
                    $('#test_' + val).val(0);
                });

                $.each(target, function (index, val) {
                    $("#" + val).val(result[val]);
                });

                $.each(result.result, function (index, val) {
                    $('#test_' + index).val(val.score);
                })
            });
    },

    /**
     * A function to create DOM elements with attributes and nested children more efficiently.
     *
     * @source https://idiallo.com/javascript/create-dom-elements-faster
     * @source https://github.com/ibudiallo/jml
     *
     * @param tagName
     * @param props
     * @param nest
     */
    ml: (tagName, props, nest) => {
        var el = document.createElement(tagName);
        if (props) {
            for (var name in props) {
                if (name.indexOf("on") === 0) {
                    el.addEventListener(name.substr(2).toLowerCase(), props[name], false)
                } else {
                    el.setAttribute(name, props[name]);
                }
            }
        }
        if (!nest) {
            return el;
        }
        return system.nester(el, nest)
    },

    /**
     * A helper function for ml that handles nesting of child elements.
     * @source https://idiallo.com/javascript/create-dom-elements-faster
     * @source https://github.com/ibudiallo/jml
     *
     * @param el
     * @param n
     * @returns {*}
     */
    nester: (el, n) => {
        if (typeof n === "string") {
            var t = document.createTextNode(n);
            el.appendChild(t);
        } else if (n instanceof Array) {
            for (var i = 0; i < n.length; i++) {
                if (typeof n[i] === "string") {
                    var t1 = document.createTextNode(n[i]);
                    el.appendChild(t1);
                } else if (n[i] instanceof Node) {
                    el.appendChild(n[i]);
                }
            }
        } else if (n instanceof Node) {
            el.appendChild(n)
        }
        return el;
    },
};