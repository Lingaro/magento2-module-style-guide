```less
@color-example: #000000;
```

```less
.style-guide-container {
  .style-guide-colors {
    .style-guide-color {
      &.style-guide-color-example {
        .style-guide-color-visualization {
          background-color: @color-example;
        }
      }
    }
  }
}
```