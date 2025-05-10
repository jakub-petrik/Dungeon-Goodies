document.addEventListener("DOMContentLoaded", function () {
    requestAnimationFrame(() => {
        initScroller("new_arrivals_scrolling", ".new_arrivals");
        initScroller("what_you_may_like_scrolling", ".what_you_may_like");
    });
});

function initScroller(scrollerId, sectionSelector) {
    const scroller = document.getElementById(scrollerId);
    const item = scroller.querySelector(".item");

    if (!item) return;

    const itemWidth = item.offsetWidth + parseInt(getComputedStyle(item).marginRight);
    const leftBtn = document.querySelector(`${sectionSelector} .scroller_button.left`);
    const rightBtn = document.querySelector(`${sectionSelector} .scroller_button.right`);

    if (leftBtn && rightBtn) {
        leftBtn.addEventListener("click", () => {
            scroller.scrollBy({
                left: -itemWidth * 3,
                behavior: "smooth"
            });
        });

        rightBtn.addEventListener("click", () => {
            scroller.scrollBy({
                left: itemWidth * 3,
                behavior: "smooth"
            });
        });
    }
}
