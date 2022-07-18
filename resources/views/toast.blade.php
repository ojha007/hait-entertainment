@if($message = session()->has('success'))
    <div class="toast active">

        <div class="toast-content">
            <i class="ic-checkmark check"></i>

            <div class="message">
                <span class="text text-1">Success</span>
                <span class="text text-2">{{session()->get('success')}}</span>
            </div>
        </div>
        <i class="ic-cancel close" style="color: black"></i>
        <div class="progress active"></div>
    </div>
@endif


@if($message = session()->has('error'))
    <div class="toast active">
        <div class="toast-content">
            <i class="ic-cancel error"></i>
            <div class="message">
                <span class="text text-1">Error</span>
                <span class="text text-2">{{session()->get('error')}}</span>
            </div>
        </div>
        <i class="ic-cancel close" style="color: black"></i>
        <div class="progress active"></div>
    </div>
@endif
<script type="text/javascript">
    let toast = document.querySelector(".toast");
    let closeIcon = document.querySelector(".close");
    let progress = document.querySelector(".progress");
    let timer1, timer2;
    if (closeIcon) {
        closeIcon.addEventListener("click", () => {
            toast.remove();
            setTimeout(() => {
                toast.remove();
            }, 300);

            clearTimeout(timer1);
            clearTimeout(timer2);
        });
    }
    if (toast) {
        setTimeout(() => {
            toast.remove();
        }, 5300);
    }

</script>

<style>

    .toast {
        position: absolute;
        top: 25px;
        z-index: 9999;
        right: 30px;
        border-radius: 12px;
        background: #fff;
        padding: 20px 35px 20px 25px;
        box-shadow: 0 6px 20px -5px rgba(0, 0, 0, 0.1);
        overflow: hidden;
        transform: translateX(calc(100% + 30px));
        transition: all 0.5s cubic-bezier(0.68, -0.55, 0.265, 1.35);
    }

    .toast.active {
        transform: translateX(0%);
    }

    .toast .toast-content {
        display: flex;
        align-items: center;
    }

    .toast-content .check {
        display: flex;
        align-items: center;
        justify-content: center;
        height: 35px;
        min-width: 35px;
        background-color: #07aa1b;
        color: #fff;
        font-size: 20px;
        border-radius: 50%;
    }

    .toast-content .error {
        display: flex;
        align-items: center;
        justify-content: center;
        height: 35px;
        min-width: 35px;
        background-color: #cd1515;
        color: #fff;
        font-size: 20px;
        border-radius: 50%;
    }

    .toast-content .message {
        display: flex;
        flex-direction: column;
        margin: 0 20px;
    }

    .message .text {
        font-size: 16px;
        font-weight: 400;
        color: #1a1919;
    }

    .message .text.text-1 {
        font-weight: 600;
        color: #1a1919;
    }

    .toast .close {
        position: absolute;
        top: 10px;
        right: 15px;
        padding: 5px;
        cursor: pointer;
        opacity: 0.7;
    }

    .toast .close:hover {
        opacity: 1;
    }

    .toast .progress {
        position: absolute;
        bottom: 0;
        left: 0;
        height: 3px;
        width: 100%;

    }

    .toast .progress:before {
        content: "";
        position: absolute;
        bottom: 0;
        right: 0;
        height: 100%;
        width: 100%;
        background-color: #4070f4;
    }

    .progress.active:before {
        animation: progress 5s linear forwards;
    }

    @keyframes progress {
        100% {
            right: 100%;
        }
    }
</style>

