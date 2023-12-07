<script setup>
import Flash from "@/Layouts/Partials/Flash.vue";
import ProfileDropdown from "@/Layouts/Partials/ProfileDropdown.vue";
</script>
<template>
    <div class="flex">
        <Flash/>

        <!-- Left -->
        <div class="min-h-screen w-[170px] bg-[#374050]">
            <div class="text-white flex gap-4">
                <div class="px-3 h-fit bg-white shrink-0 w-16 rounded-br-xl">
                    <img src="/img/logo.png" alt="">
                </div>
                <div class="mt-1 text-[8px] flex flex-col">
                    <span class="h-2">Enterprise</span>
                    <span class="h-2">Resource</span>
                    <span class="h-2">Planning</span>
                </div>
            </div>

            <!-- left menu -->
            <div class="pt-3 px-6 text-xs text-gray-300">
                <span>Продукты</span>
            </div>
        </div>

        <!-- Right -->
        <div class="w-full">
            <!-- Header -->
            <div class="px-6 w-full bg-white flex items-center h-12 justify-between">
                <Link href="/" class="text-red-600 uppercase font-semibold">
                    Продукты
                </Link>

                <!-- User/Login -->
                <ProfileDropdown class="text-gray-700">ere</ProfileDropdown>
            </div>

            <!-- Main -->
            <main class="bg-gray-100">
                <slot/>
            </main>
        </div>
    </div>
</template>
