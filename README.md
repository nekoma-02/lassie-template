# lassie-template
## **Техническое задание**
Интегрировать верстку на следующих страницах
- Главная
- Каталог
- Детальная страница товара
- Корзина

Главная страница делится на 3 части - header, footer, workflow.
Части **header** и **footer** на всех страницах статические(одинаковые).

Используемые компоненты в части **header**:
- bitrix:main.include
- bitrix:sale.basket.basket.line
- bitrix:menu

Используемые компоненты в части **footer**:
- bitrix:main.include
- bitrix:menu

Используемые компоненты в части **workflow** на **главной** странице:
- bitrix:news.list
- bitrix:sale.bestsellers

Используемые компоненты в части **workflow** на странице **каталог**:
- bitrix:breadcrumb
- bitrix:catalog(комплексный компонент)

Используемые компоненты в части **workflow** на странице **детальная страница товара**:
- bitrix:catalog(комплексный компонент)

Используемые компоненты в части **workflow** на странице **корзина**:
- bitrix:sale.order.ajax
- bitrix:breadcrumb
