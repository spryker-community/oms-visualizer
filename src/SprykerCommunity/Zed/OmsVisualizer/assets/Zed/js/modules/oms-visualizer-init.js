import mermaid from 'mermaid';
import elkLayouts from '@mermaid-js/layout-elk';

mermaid.registerLayoutLoaders(elkLayouts);

export function runOmsVisualizer(config = {}) {
    mermaid.initialize(config);
    mermaid.run();
}
