(function () {
    var draggingItem = null;

    function updateHidden(list) {
        var hidden = list.querySelector('input[type="hidden"]');
        if (!hidden) return;

        var inputs = Array.prototype.slice.call(list.querySelectorAll('li input'));
        var values = inputs
            .filter(function (input) {
                return input.type !== 'hidden' && input.name;
            })
            .map(function (input) {
                var active = input.checked ? '1' : '0';
                return input.name + ':' + active;
            })
            .join(',');

        hidden.value = values;
        hidden.dispatchEvent(new Event('change', { bubbles: true }));
    }

    function getDragAfterElement(container, y) {
        var draggableElements = Array.prototype.slice
            .call(container.querySelectorAll('li[draggable="true"]:not(.dragging)'));

        var closest = { offset: Number.NEGATIVE_INFINITY, element: null };
        draggableElements.forEach(function (child) {
            var box = child.getBoundingClientRect();
            var offset = y - box.top - box.height / 2;
            if (offset < 0 && offset > closest.offset) {
                closest = { offset: offset, element: child };
            }
        });

        return closest.element;
    }

    function makeListSortable(list) {
        var items = Array.prototype.slice.call(list.querySelectorAll('li'));
        items.forEach(function (li) {
            li.setAttribute('draggable', 'true');

            li.addEventListener('dragstart', function () {
                draggingItem = li;
                li.classList.add('dragging');
            });

            li.addEventListener('dragend', function () {
                li.classList.remove('dragging');
                draggingItem = null;
                updateHidden(list);
            });
        });

        list.addEventListener('dragover', function (e) {
            if (!draggingItem) return;
            e.preventDefault();
            var afterElement = getDragAfterElement(list, e.clientY);
            if (afterElement == null) {
                list.appendChild(draggingItem);
            } else {
                list.insertBefore(draggingItem, afterElement);
            }
        });

        list.addEventListener('change', function (e) {
            if (e.target && e.target.matches('li input')) {
                updateHidden(list);
            }
        });

        updateHidden(list);
    }

    document.addEventListener('DOMContentLoaded', function () {
        var lists = document.querySelectorAll('ul.my-multicheck-sortable-list');
        for (var i = 0; i < lists.length; i++) {
            makeListSortable(lists[i]);
        }
    });
})();
