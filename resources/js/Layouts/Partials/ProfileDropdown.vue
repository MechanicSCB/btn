<script setup>
import JetDropdown from '@/Components/Dropdown.vue';
import JetDropdownLink from '@/Components/DropdownLink.vue';
import {router} from "@inertiajs/vue3";

const logout = () => {
    router.post(route('logout'));
};
</script>

<template>
    <div class="text-sm">
        <JetDropdown v-if="$page.props.auth.user" align="right" width="48">
            <template #trigger>
                <button class="flex items-center text-sm border-2 border-transparent rounded-full focus:outline-none transition">
                    <span class="flex">{{ $page.props.auth.user.name }}</span>
                </button>
            </template>

            <template #content>
                <div class="block px-4 py-2 text-xs text-gray-400">
                    Управление профилем
                </div>

                <JetDropdownLink :href="route('profile.show')">
                    Настройки профиля
                </JetDropdownLink>

                <div class="border-t border-gray-100"/>

                <!-- Logout -->
                <form @submit.prevent="logout">
                    <JetDropdownLink as="button">
                        Выйти
                    </JetDropdownLink>
                </form>
            </template>
        </JetDropdown>

        <Link v-else class="h-5 flex hover:underline" :href="route('login')">
            <i class="bi bi-person-fill mr-1"></i>
            Войти
        </Link>
    </div>
</template>


