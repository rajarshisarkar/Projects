/*
 * To run this code:
 * 1. javac -classpath ../lib/jcommon-1.0.23.jar:../lib/jfreechart-1.0.19.jar StatisticsYearwise.java
 * 2. java StatisticsYearwise
*/

import java.awt.BasicStroke;
import java.awt.BorderLayout;
import java.awt.Color;
import javax.swing.JPanel;
import javax.swing.JLabel;
import java.awt.Stroke;
import java.io.BufferedReader;
import java.io.FileReader;
import java.io.IOException;
import org.jfree.chart.ChartFactory;
import org.jfree.chart.ChartPanel;
import org.jfree.chart.JFreeChart;
import org.jfree.chart.axis.NumberAxis;
import org.jfree.chart.axis.CategoryAxis;
import org.jfree.chart.plot.CategoryPlot;
import org.jfree.chart.plot.PlotOrientation;
import org.jfree.chart.renderer.category.LineAndShapeRenderer;
import org.jfree.data.category.CategoryDataset;
import org.jfree.data.category.DefaultCategoryDataset;
import org.jfree.ui.ApplicationFrame;
import org.jfree.ui.RefineryUtilities;
import org.jfree.chart.axis.CategoryLabelPositions;

public class StatisticsYearwise extends ApplicationFrame {

    int count = 0;
	private static final long serialVersionUID = 1L;
	
    public StatisticsYearwise(final String title) {
	super(title);
	final CategoryDataset dataset = createDataset();
	final JFreeChart chart = createChart(dataset);
	final ChartPanel chartPanel = new ChartPanel(chart);
	chartPanel.setPreferredSize(new java.awt.Dimension(1024, 768));
	this.add(chartPanel, BorderLayout.CENTER);
	JPanel customPanel = new JPanel();
	JLabel lbl = new JLabel("<html><h4>Total papers published in year [1960, 2009]: " + count + "</h4></html>");
	customPanel.add(lbl);
	this.add(customPanel, BorderLayout.SOUTH);
    }

    private CategoryDataset createDataset() {
	DefaultCategoryDataset dataset = null;
	BufferedReader br = null;
	try {
	    String sCurrentLine;
	    br = new BufferedReader(new FileReader("../data/taggeddataset"));
	    int year;
	    int[] yearstatistics = new int[50];
	    //int min = 2016, max = 0;
	    while ((sCurrentLine = br.readLine()) != null) {
		String toprocess = sCurrentLine;
		if (toprocess.matches("#t(.*)")) {
		    year = Integer.parseInt(toprocess.substring(2, toprocess.length()));
		    yearstatistics[year - 1960] = yearstatistics[year - 1960] + 1;
		}
	    }
	    dataset = new DefaultCategoryDataset();
	    for (int i = 0; i < 50; i++) {
		Integer k = new Integer(1960 + i);
		dataset.addValue(yearstatistics[i], "No. of papers published in a particular year", k.toString());
		System.out.print("Papers published in year " + (1960 + i) + ": " + yearstatistics[i] + "\n");
		count = count + yearstatistics[i];
	    }
	    System.out.println("Total papers published in year [1960, 2009]: " + count);
	} catch (IOException e) {
	    e.printStackTrace();
	} finally {
	    try {
		if (br != null)
		    br.close();
	    } catch (IOException ex) {
		ex.printStackTrace();
	    }
	}

	return dataset;
    }

    private JFreeChart createChart(final CategoryDataset dataset) {
	final JFreeChart chart = ChartFactory.createLineChart("No. of papers published vs Year plot", // chart
		"Year", // domain(x-axis) axis label
		"No. of papers published", // range(y-axis) axis label
		dataset, // data
		PlotOrientation.VERTICAL, // orientation
		true, // include legend
		true, // tooltips
		false // urls
		);

	chart.setBackgroundPaint(Color.white);
	final CategoryPlot plot = (CategoryPlot) chart.getPlot();
	plot.setBackgroundPaint(new Color(0xffffe0));
	plot.setDomainGridlinesVisible(true);
	plot.setDomainGridlinePaint(Color.lightGray);
	plot.setRangeGridlinePaint(Color.lightGray);
	final CategoryAxis domainAxis = plot.getDomainAxis();
	domainAxis.setCategoryLabelPositions(CategoryLabelPositions.UP_90);
	final NumberAxis rangeAxis = (NumberAxis) plot.getRangeAxis();
	rangeAxis.setStandardTickUnits(NumberAxis.createIntegerTickUnits());
	rangeAxis.setAutoRangeIncludesZero(true);
	final LineAndShapeRenderer renderer = (LineAndShapeRenderer) plot.getRenderer();
	renderer.setBaseShapesFilled(true);
	renderer.setBaseShapesVisible(true);
	Stroke stroke = new BasicStroke(3f, BasicStroke.CAP_ROUND, BasicStroke.JOIN_BEVEL);
	renderer.setBaseOutlineStroke(stroke);

	return chart;
    }

    public static void main(final String[] args) {
	final StatisticsYearwise demo = new StatisticsYearwise("");
	demo.pack();
	RefineryUtilities.centerFrameOnScreen(demo);
	demo.setVisible(true);
    }
}
