<template>
  <DropdownMenuItem
    :as="as"
    :href="href"
    :method="method"
    class="cursor-pointer"
  >
    <slot />
  </DropdownMenuItem>
</template>

<script setup lang="ts">
import { DropdownMenuItem } from '@/components/ui/dropdown-menu'

interface Props {
  href?: string
  method?: string
  as?: string
}

defineProps<Props>()
</script>
